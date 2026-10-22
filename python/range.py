numbers = [4, 6, 4, 8, 6, 4, 10]
numbers_a = [12, 5, 20, 8]

def get_range(number_list):
    largest_number = max(number_list)
    smallest_number = min(number_list)

    return largest_number - smallest_number

print(get_range(numbers))
print(get_range(numbers_a))
