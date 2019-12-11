import pandas as pd
import numpy as np
import configs as configs #Import configurations

class AllocateElective:

	def __init__(self):

		#Read elective preferences from CSV file and store in numpy array
		self.preferences = pd.read_csv(configs.preferences_file).values

		#Getting specifications from the configs file
		totalStudents = configs.totalStudents #Total number of students
		numberofElectives = configs.numberofElectives #Number of Electives
		class_strengths = configs.class_strengths #Strength of each Elective (list)
		generations = configs.generations #Number of generations the algorithm will perform
		population_cap = configs.population_cap #Size of the population per generation

		#Creating the first generation population

		#First chromosome has alphabetical order
		#Creating a list with values from 0 to (Number of Students - 1), each representing a student
		self.chromosome = [int(i) for i in range(0,totalStudents)]

		for i in range(0,population_cap):

			for j in range(0,totalStudents):

				self.population[i][j] = self.chromosome[j]

			#Allocating electives for current chromosome	
			self.allocate(self.chromosome) #Stores allocation in self.allocation

			#Get Fitness for the allocation
			self.fitnesScore = self.calculateFitness(self.allocation) 
			
			#Store the fitness score along with the corresponding chromosome
			self.population[i][students] = self.fitnesScore

			#Randomly shuffle the chromosome to create rest of the population
			numpy.random.shuffle(self.chromosome)

		#TO-DO
		#-Support functions
		#-Write code for rest of the generations 


	#Calculates fitness for current allocation
	def calculateFitness(self):

		#Initialize score
        fitnessScore = 0
        #List to score allocation details
        self.fitnessDetails = [0 for l1 in range(5)]
        
        for l1 in range(numberofElectives):

            for l2 in range(totalStudents):

            	#Store allocation details
            	#Each index stores how much students have been given electives as per their preferences
            	#For Example: Index 1 may contain how many students were given their most preferred course and so on ...    
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
    	self.allocation = [[0 for i in range(totalStudents)] for j in range(numberofElectives)]

    	for s in range(totalStudents):

    		#Allocating electives to each student one-by-one 
    		currentStudent = chromosome[s]

    		for e in range(numberofElectives):

    			preferrefElective = self.findPreferredElective(e,currentStudent)
    			
    			if not(isElectiveFull(preferrefElective)):

    				self.allocation[preferrefElective][currentStudent] = 1
    				break


    #Returns nth preferred course of a student
    def findPreferredElective(self,n,student):

    	#Empty preference table 
    	studentPreference = [[0 for i in range(2)] for j in range(numberofElectives)]

        for pfi in range(numberofElectives):

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

        currentStrength = sum(int(self.allocation[elective][v]) for v in range(totalStudents))

        if (currentStrength < class_strengths[elective]) :

            return False

        else :

            return True


    #Loads best chromosomes which are the parents for the next generation.
    def __parentLoader(self):

        self.parent1 = [self.population[0][i] for i in range(totalStudents)]  
        self.parent2 = [self.population[1][i] for i in range(totalStudents)]