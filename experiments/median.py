numbers = [23, 32, 12, 21, 5] # Test odd numbers
# numbers = [2, 7, 9, 11] # Test even numbers

def get_median(number_list):
    sorted_list = sorted(number_list)
    median_index = len(number_list) // 2

    if (len(number_list) % 2 == 0):
        median = (sorted_list[median_index] + sorted_list[median_index -1]) / 2
        return median
    else:
        return sorted_list[median_index]
    
median = get_median(numbers)

print(median)