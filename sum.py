def sum(x,y,z=1):
    return x + y + z


def sum_list(l):
    total = 0
    for i in l:
        total += i
    return total

x = 10
y = 20
print(sum(x,y))
print(sum_list([1,2,3,4,5,6]))
