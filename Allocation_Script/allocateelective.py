import pandas as pd
import numpy as np
import configs as configs


class AllocateElective:

    def __init__(self):

        self.totalStudents = 0
        self.numberofElectives = 0

        # Format input from web-app
        self.__formatPreferences()

        # Read elective preferences from CSV file and store in numpy array
        self.preferences = pd.read_csv(
            configs.preferences_file, header=None).values

        # Strength of each Elective (list)
        class_size_df = pd.read_csv(configs.data_dir + 'max.csv')
        self.class_strengths = list(class_size_df.values)
        # Number of generations the algorithm will perform
        self.generations = 100
        # Size of the population per generation
        self.population_cap = 10

        # Creating the first generation population

        # First chromosome has alphabetical order
        # Creating a list with values from 0 to (Number of Students - 1), each
        # representing a student
        self.chromosome = [int(i) for i in range(0, self.totalStudents)]

        self.population = [
            [0 for x in range(self.totalStudents + 1)] for y in range(self.population_cap)]

        for i in range(0, self.population_cap):

            for j in range(0, self.totalStudents):

                self.population[i][j] = self.chromosome[j]

            # Allocating electives for current chromosome
            # Stores allocation in self.allocation
            self.allocate(self.chromosome)

            # Get Fitness for the allocation
            self.fitnessScore = self.calculateFitness()

            # Store the fitness score along with the corresponding chromosome
            self.population[i][self.totalStudents] = self.fitnessScore

            # Randomly shuffle the chromosome to create rest of the population
            np.random.shuffle(self.chromosome)

        self.currentGeneration = 0

        for g in range(self.generations):

            # print("GEN : " + str(gen+1))

            # Get parents from previous generation
            self.__parentLoader()

            # Perform PMX cross-over
            self.__Cycx()

            # Create rest of the population by mutating the child-chromosomes of
            # selected parents after cross-over
            self.__populateNextGeneration2()
            self.population.sort(
                key=lambda i: i[self.totalStudents], reverse=True)

            self.currentGeneration += 1

        # Stores best allocation to allocations.csv
        self.storeBestAllocation()

        # Formats output for web-app
        self.__formatAllocation()

    # Calculates fitness for current allocation
    def calculateFitness(self):

        # Initialize score
        fitnessScore = 0

        for l1 in range(self.numberofElectives):

            for l2 in range(self.totalStudents):

                # Calculate fitness score
                # Score calculated by a reward mechanism where the algorithm is given a high score
                # if it has allocated students to their respective most preferred course.
                # Lesser points for the opposite case.
                fitnessScore += int(self.preferences[l1]
                                    [l2]) * int(self.allocation[l1][l2])

        # Return calculated fitness score
        return fitnessScore

    # Allocates electives for a chromosome
    def allocate(self, chromosome):

        # Empty allocation
        self.allocation = [
            [0 for i in range(self.totalStudents)] for j in range(self.numberofElectives)]

        for s in range(self.totalStudents):

            # Allocating electives to each student one-by-one
            currentStudent = chromosome[s]

            for e in range(self.numberofElectives):

                preferrefElective = self.findPreferredElective(
                    e, currentStudent)

                # Check if the requested elective has vacant seats
                if not(self.isElectiveFull(preferrefElective)):

                    self.allocation[preferrefElective][currentStudent] = int(1)
                    break

    # Returns nth preferred course of a student
    def findPreferredElective(self, n, student):

        # Empty preference table
        studentPreference = [
            [0 for i in range(2)] for j in range(self.numberofElectives)]

        # print(len(self.preferences))

        for pfi in range(self.numberofElectives):

            # Preferences
            studentPreference[pfi][0] = self.preferences[pfi][student]
            # Elective number
            studentPreference[pfi][1] = pfi

        # Sort electives with respect to preference
        studentPreference.sort(key=lambda pfi: pfi[0], reverse=True)

        # nth preferred course
        return studentPreference[n][1]

    # Checks if an elective is full
    def isElectiveFull(self, elective):

        currentStrength = 0

        # Find the number of students already allocated to the elective
        currentStrength = sum(int(self.allocation[elective][
                              v]) for v in range(self.totalStudents))

        if (currentStrength < self.class_strengths[elective]):

            return False

        else:

            return True

    # Store Best Allocation
    def storeBestAllocation(self):

        # Create empty chromosome
        self.bestChromosome = [0 for ti in range(self.totalStudents)]
        # Get the best chromosome from the population
        self.bestChromosome = [self.population[0][i]
                               for i in range(self.totalStudents)]
        # Get the allocation for the best chromosome
        self.allocate(self.bestChromosome)
        # Get the fitness score
        self.bestFitnessScore = self.calculateFitness()
        # Save it to CSV file
        np.savetxt(configs.data_dir + "allocations.csv",
                   np.array(self.allocation).astype(int), delimiter=',', newline='\n', fmt='%i')

    # Loads best chromosomes which are the parents for the next generation.
    def __parentLoader(self):

        self.parent1 = [self.population[0][i] for i in range(
            self.totalStudents)]  # Chromosome with highest fitness
        # Chromosome with second highest fitness
        self.parent2 = [self.population[1][i]
                        for i in range(self.totalStudents)]

    # Creates population by mutating two child-chromosomes
    def __populateNextGeneration2(self):

        for i in range(int(self.population_cap / 2)):

            for j in range(self.totalStudents):

                self.population[i][j] = self.child1[j]
                self.population[i + 5][j] = self.child2[j]

            self.allocate(self.child1)
            self.fitnessScore = self.calculateFitness()
            self.population[i][self.totalStudents] = self.fitnessScore

            self.allocate(self.child2)
            self.fitnessScore = self.calculateFitness()
            self.population[i + 5][self.totalStudents] = self.fitnessScore

            self.__insertMutation(self.child1)  # Using insert-mutation
            self.__insertMutation(self.child2)  # Using insert-mutation

    # Mutation by insertion method
    def __insertMutation(self, chromosome):

        e = np.random.choice(self.totalStudents - 1)
        r = e + (np.random.choice(self.totalStudents - e))

        te = chromosome[e + 1]
        chromosome[e + 1] = chromosome[r]
        chromosome[r] = te

    def rec(self, pmxg, pmxarr, pmxpar, pmxa, pmxb):
        for pmxy in range(self.totalStudents):
            if(pmxpar[pmxy] == pmxarr[pmxg]):
                break
        if(pmxa <= pmxy and pmxy <= pmxb):
            return self.rec(pmxy, pmxarr, pmxpar, pmxa, pmxb)
        else:
            return pmxy

    # Cyclic Cross-over
    def __Cycx(self):

        z = [-1 for i in range(self.totalStudents)]
        self.child1 = [-1 for i in range(self.totalStudents)]
        self.child2 = [-1 for i in range(self.totalStudents)]
        cycflag = 1

        for i in range(self.totalStudents):

            if z[i] == -1:

                s1 = i

                while (z[s1] != cycflag):

                    z[s1] = cycflag

                    sv = self.parent2[s1]

                    s1 = self.parent1.index(sv)

                cycflag += 1

        for i in range(self.totalStudents):

            if (z[i] % 2 == 1):

                self.child1[i] = self.parent1[i]
                self.child2[i] = self.parent2[i]

            else:

                self.child1[i] = self.parent2[i]
                self.child2[i] = self.parent1[i]

    def __formatPreferences(self):

        pref_from_web = pd.read_csv(
            configs.data_dir + 'preferences_from_web.csv')

        pref_from_web.drop(columns=['SID'], inplace=True)

        prefValues = pref_from_web.values

        prefValues = prefValues.T

        (self.numberofElectives, self.totalStudents) = prefValues.shape

        np.savetxt(configs.data_dir + "preferences.csv",
                   np.array(prefValues).astype(int), delimiter=',', newline='\n', fmt='%i')

    def __formatAllocation(self):

        alloc_from_algo = pd.read_csv(
            configs.data_dir + 'allocations.csv', header=None)

        pref_from_web = pd.read_csv(
            configs.data_dir + 'preferences_from_web.csv')

        alloc_to_web = pd.DataFrame()
        alloc_to_web['SID'] = pref_from_web['SID'].values
        alloc_to_web['CID'] = [list(i).index(
            1) + 1 for i in alloc_from_algo.values.T]

        alloc_to_web.to_csv(configs.data_dir + 'alloc_to_web.csv', index=False)


if __name__ == '__main__':
    ae = AllocateElective()
