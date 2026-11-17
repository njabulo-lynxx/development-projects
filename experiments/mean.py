numbers = []

def get_total(number_list):
    return sum(number_list)

def get_mean(number_list):
    return get_total(number_list) / len(number_list)

mean = get_mean(numbers)
print(mean)