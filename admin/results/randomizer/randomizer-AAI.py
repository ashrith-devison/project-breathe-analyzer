import sys
import random
import json
from math import ceil

# Retrieve the list of elements as a string from command-line arguments
elements_string = sys.argv[1]
elements_string = elements_string.replace("[", "").replace("]", "")

my_list = elements_string.split(',')
percent = int(sys.argv[2]) / 100
num_elements_to_pick = ceil(len(my_list) * percent)
stand_by_element = ceil(len(my_list) * ((int(sys.argv[2]) + 10) / 100))
random_elements = random.sample(my_list, stand_by_element)

# Create a dictionary with the random elements and the pending count
random_data_dict = {
    "employees": random_elements,
    "pending": num_elements_to_pick,
    "Error" : "No"
}

# Convert the dictionary to a JSON string
random_data = json.dumps(random_data_dict)
print(random_data)