import pandas as pd
import numpy as np
import configs as configs #Import configurations

class AllocateElective:

	def __init__(self):

		#Read elective preferences from CSV file and store in numpy array
		self.preferences = pd.read_csv(configs.preferences_file).values

		#Getting specifications from the configs file
		self.totalStudents = configs.totalStudents #Total number of students
		self.numberofElectives = configs.numberofElectives #Number of Electives
		self.class_strengths = configs.class_strengths #Strength of each Elective (list)
		self.generations = configs.generations #Number of generations the algorithm will perform
		self.population_cap = configs.population_cap #Size of the population per generation

		#Creating the first generation population

		#First chromosome has alphabetical order
		#Creating a list with values from 0 to (Number of Students - 1), each representing a student
		self.chromosome = [int(i) for i in range(0,self.totalStudents)]

		for i in range(0,self.population_cap):

			for j in range(0,self.totalStudents):

				self.population[i][j] = self.chromosome[j]

			#Allocating electives for current chromosome	
			self.allocate(self.chromosome) #Stores allocation in self.allocation

			#Get Fitness for the allocation
			self.fitnessScore = self.calculateFitness(self.allocation) 
			
			#Store the fitness score along with the corresponding chromosome
			self.population[i][students] = self.fitnessScore

			#Randomly shuffle the chromosome to create rest of the population
			numpy.random.shuffle(self.chromosome)


		for g in range(generations) :

            #print("GEN : " + str(gen+1))

            #Get parents from previous generation
            self.__parentloader()

            #Perform PMX cross-over
            self.__PMX()

            #Create rest of the population by mutating the child-chromosomes of selected parents after cross-over
            self.__populateNextGeneration2()
            self.population.sort(key=lambda i:i[self.totalStudents],reverse=True)


            #self.store_avg_fitness()
            #print(self.population)
            #numpy.savetxt("Z:\EAinPY\pypops" + str(gen+1) + ".txt",numpy.array(self.population),fmt='%1.1d',delimiter = ' ',newline = '\n')
            
            self.currentGeneration += 1

        self.storeBestAllocation()

		#TO-DO
		#-Support functions
		#-Write code for rest of the generations 
		#-Add mutation functions
		#-Add cross-over functions


	#Calculates fitness for current allocation
	def calculateFitness(self):

		#Initialize score
        fitnessScore = 0
        #List to score allocation details
        self.fitnessDetails = [0 for l1 in range(5)]
        
        for l1 in range(self.numberofElectives):

            for l2 in range(self.totalStudents):

            	#Store allocation details
            	#Each index stores how much students have been given electives as per their preferences
            	#For Example: Index 1 may contain how many students were given their most preferred course 
            	#and so on ...    
                self.fitnessDetails[int(self.preferences[l1][l2])] += int(self.allocation[l1][l2])

                #Calculate fitness score
                #Score calculated by a reward mechanism where the algorithm is given a high score
                #if it has allocated students to their respective most preferred course.
                #Lesser points for the opposite case.              
                fitnessScore += int(self.preferences[l1][l2])*int(self.allocation[l1][l2])

        #Return calculated fitness score
        return fitnessScore


    #Allocates electives for a chromosome
    def allocate(self, chromosome):

    	#Empty allocation
    	self.allocation = [[0 for i in range(self.totalStudents)] for j in range(self.numberofElectives)]

    	for s in range(totalStudents):

    		#Allocating electives to each student one-by-one 
    		currentStudent = chromosome[s]

    		for e in range(self.numberofElectives):

    			preferrefElective = self.findPreferredElective(e,currentStudent)
    			
    			#Check if the requested elective has vacant seats 
    			if not(isElectiveFull(preferrefElective)):

    				self.allocation[preferrefElective][currentStudent] = 1
    				break


    #Returns nth preferred course of a student
    def findPreferredElective(self,n,student):

    	#Empty preference table 
    	studentPreference = [[0 for i in range(2)] for j in range(self.numberofElectives)]

        for pfi in range(self.numberofElectives):

        	#Preferences
            studentPreference[pfi][0] = self.preferences[pfi][student]
            #Elective number
            studentPreference[pfi][1] = pfi

        #Sort electives with respect to preference
        studentPreference.sort(key=lambda pfi:pfi[0],reverse=True) 

        #nth preferred course
        return studentPreference[n][1]


    #Checks if an elective is full
    def isElectiveFull(self,elective):

        currentStrength = 0

        #Find the number of students already allocated to the elective
        currentStrength = sum(int(self.allocation[elective][v]) for v in range(self.totalStudents))

        if (currentStrength < class_strengths[elective]) :

            return False

        else :

            return True


    #Store Best Allocation
    def storeBestAllocation(self):

    	#Create empty chromosome
        self.bestChromosome = [0 for ti in  range(self.totalStudents)]
        #Get the best chromosome from the population
        self.bestChromosome = [self.population[0][i] for i in range(self.totalStudents)]
        #Get the allocation for the best chromosome
        self.allocate(self.bestChromosome)
        #Get the fitness score
        self.bestFitnessScore = self.calculateFitness(self.allocation)
        #Save it to CSV file
        numpy.savetxt(configs.data_dir + "BestAllocation.csv",numpy.array(self.allocation), delimiter = ',', newline = '\n')


    #Loads best chromosomes which are the parents for the next generation.
    def __parentLoader(self):

        self.parent1 = [self.population[0][i] for i in range(totalStudents)] #Chromosome with highest fitness
        self.parent2 = [self.population[1][i] for i in range(totalStudents)] #Chromosome with second highest fitness


    #Creates population by mutating two child-chromosomes
    def __populateNextGeneration2(self):

        for i in range(self.population_cap/2) :

            for j in range(self.totalStudents) :

                self.population[i][j] = self.child1[j]
                self.population[i+5][j] = self.child2[j]

            self.allocate(self.child1)
            self.fitnessScore = self.calculateFitness(self.allocation)
            self.population[i][totalStudents] = self.fitnessScore

            self.allocate(self.child2)
            self.fitnessScore = self.calculateFitness(self.allocation)
            self.population[i+5][totalStudents] = self.fitnessScore       

            self.__insertMutation(self.child1) #Using insert-mutation
            self.__insertMutation(self.child2) #Using insert-mutation


    #Mutation by insertion method
    def __insertMutation(self,chromosome):

        e = numpy.random.choice(self.totalStudents-1)
        r = e+(numpy.random.choice(self.totalStudents-e))

        te = chromosome[e+1]
        chromosome[e+1] = chromosome[r]
        chromosome[r] = te


    def rec(self,pmxg,pmxarr,pmxpar,pmxa,pmxb):
        for pmxy in range(self.totalStudents):
            if(pmxpar[pmxy]==pmxarr[pmxg]):
                break
        if(pmxa<=pmxy and pmxy<=pmxb):
            return self.rec(pmxy,pmxarr,pmxpar,pmxa,pmxb)
        else:
            return pmxy


    #PMX Cross-over
    def __PMX(self):
    
        pmxl=numpy.random.randint(self.totalStudents)
        pmxu=40 #Have To find what this is ...
        self.child1=[-1 for i in range(self.totalStudents)]
        self.child2=[-1 for i in range(self.totalStudents)]

        #print ('\n ******* \n'+ str(self.parent1))
        
        for pmxi in range(pmxl,pmxu+1):
            self.child1[pmxi]=self.parent1[pmxi]

        for pmxi in range(pmxl,pmxu+1,1):
            for pmxy in range(self.totalStudents):
                if(self.parent2[pmxy]==self.child1[pmxi]):
                    break
            pmxflag=1
            for pmxk in range(pmxl,pmxu+1,1):
                if(self.parent1[pmxk]==self.parent2[pmxi]):
                
                    pmxflag=0
            if(pmxflag==1):
                if(pmxl<=pmxy and pmxy<=pmxu+1):
                    z=self.rec(pmxy,self.child1,self.parent2,pmxl,pmxu)
                    self.child1[z]=self.parent2[pmxi]

                else:
                    self.child1[pmxy]=self.parent2[pmxi]

        for pmxi in range(self.totalStudents):
            if(self.child1[pmxi]==-1):
                self.child1[pmxi]=self.parent2[pmxi]

        for pmxi in range(pmxl,pmxu+1):
            self.child2[pmxi]=self.parent2[pmxi]

        for pmxi in range(pmxl,pmxu+1,1):
            for pmxy in range(self.totalStudents):
                if(self.parent1[pmxy]==self.child2[pmxi]):
                    break
            pmxflag=1
            for pmxk in range(pmxl,pmxu+1,1):
                if(self.parent2[pmxk]==self.parent1[pmxi]):
                
                    pmxflag=0
            if(pmxflag==1):
                if(pmxl<=pmxy and pmxy<=pmxu+1):
                    z=self.rec(pmxy,self.child2,self.parent1,pmxl,pmxu)
                    self.child2[z]=self.parent1[pmxi]

                else:
                    self.child2[pmxy]=self.parent1[pmxi]

        for pmxi in range(self.totalStudents):
            if(self.child2[pmxi]==-1):
                self.child2[pmxi]=self.parent1[pmxi]
