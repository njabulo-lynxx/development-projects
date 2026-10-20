numbers = [5, 10, 15]

def get_total(number_list):
    return sum(number_list)

def get_mean(number_list):
    return get_total(number_list) / len(number_list)

total = get_total(numbers)
print(total)

mean = get_mean(numbers)
print(mean)