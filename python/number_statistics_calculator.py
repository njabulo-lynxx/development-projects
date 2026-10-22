numbers = [4, 6, 4, 8, 6, 4, 10]

def get_total(number_list):
    return sum(number_list)

def get_mean(number_list):
    return get_total(number_list) / len(number_list)

def get_median(number_list):
    sorted_list = sorted(number_list)
    median_index = len(number_list) // 2

    if (len(number_list) % 2 == 0):
        median = (sorted_list[median_index] + sorted_list[median_index -1]) / 2
        return median
    else:
        return sorted_list[median_index]

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

def get_range(number_list):
    largest_number = max(number_list)
    smallest_number = min(number_list)

    return largest_number - smallest_number

#########################################
# Testing site: Be warned script kiddies!

# Test mean
print(get_mean(numbers))

# Test median
print(get_median(numbers))

# Test mode
print(get_mode(numbers))

# Test range
print(get_range(numbers))