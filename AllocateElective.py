import pandas as pd
import numpy as np
import configs as configs #Import configurations

class AllocateElective:

	def __init__(self):

		#Read elective preferences from CSV file and store in numpy array
		self.preferences = pd.read_csv(configs.preferences_file).values

		#Getting specifications from the configs file
		totalStudents = configs.totalStudents #Total number of students
		nubmerofElectives = configs.nubmerofElectives #Number of Electives
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
			self.fitnesScore = self.findFitness(self.allocation) 
			
			#Store the fitness score along with the corresponding chromosome
			self.population[i][students] = self.fitnesScore

			#Randomly shuffle the chromosome to create rest of the population
			numpy.random.shuffle(self.chromosome)

		#TO-DO
		#-Support functions
		#-Write code for rest of the generations 
		#-Add mutation functions
		#-Add cross-over functions









