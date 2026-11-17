numbers = [5, 5, 5, 5]

def get_total(number_list):
    return sum(number_list)

def get_mean(number_list):
    if (len(number_list) == 0):
        return None

    return get_total(number_list) / len(number_list)

def get_median(number_list):
    sorted_list = sorted(number_list)

    if (len(number_list) == 0):
        return None

    median_index = len(number_list) // 2

    if (len(number_list) % 2 == 0):
        median = (sorted_list[median_index] + sorted_list[median_index -1]) / 2
        return median
    else:
        median = sorted_list[median_index]
        return median

def get_mode(number_list):
    counts = []
    modes = []

    if (len(number_list) == 0):
        return None

    for number in number_list:
        counts.append(number_list.count(number))

    largest_count = max(counts)

    for number in number_list:
        if (number_list.count(number) == largest_count and number not in modes):
            modes.append(number)

    return modes

def get_range(number_list):
    if (len(number_list) == 0):
        return None

    largest_number = max(number_list)
    smallest_number = min(number_list)

    return largest_number - smallest_number

#########################################
# Testing site: Be warned script kiddies!

# Test mean
print()
#print(f"Mean: {get_mean(numbers)}")
print(f"Mean: {get_mean([2, 4, 6])}")
print(f"Mean: {get_mean([])}")

# Test median
print()
#print(f"Median: {get_median(numbers)}")
print(f"Median: {get_median([2, 4, 6])}")
print(f"Median: {get_median([])}")

# Test mode
print()
#print(f"Mode: {get_mode(numbers)}")
print(f"Mode: {get_mode([2, 4, 6])}")
print(f"Mode: {get_mode([])}")

# Test range
print()
#print(f"Range: {get_range(numbers)}")
print(f"Range: {get_range([])}")
print(f"Range: {get_range([3, 8, 5])}")
print(f"Range: {get_range([7])}")
