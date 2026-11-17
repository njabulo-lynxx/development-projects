numbers = [4, 6, 4, 8, 6, 4, 10]
numbers_a = [2, 2, 3, 5, 2, 7]
numbers_b = [4, 6, 4, 8, 6, 4, 10]
numbers_c = [2, 2, 3, 3, 5]

def get_mode(number_list):
    counts = []
    modes = []

    for number in number_list:
        counts.append(number_list.count(number))

    largest_count = max(counts)

    for number in number_list:
        if (number_list.count(number) == largest_count and number not in modes):
            modes.append(number)

    return modes

print(get_mode(numbers))
print(get_mode(numbers_a))
print(get_mode(numbers_b))
print(get_mode(numbers_c))