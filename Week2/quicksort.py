import json
from pprint import pprint

comparisons = 0

def quicksort(lst, l, r):
	if l < r:
		#print "l: %s r: %s " % (l,r)
		#pprint(lst[l:r])
		pivot = partition(lst, l, r)
		quicksort(lst, l, pivot - 1)
		quicksort(lst, pivot + 1, r)

def find_median(lst):
	if len(lst) % 2 == 1:
		# Odd case: 0 1 2 3 4 => 2
		middle_index = (len(lst) - 1) / 2

	else:
		# Even case: 0 1 2 3 => 1
		middle_index = len(lst) / 2 - 1

	first = lst[0]
	middle = lst[middle_index]
	last = lst[-1]

	choice_value = sorted([first, middle, last])[1]

	if choice_value == first:
		median_index = 0
	elif choice_value == last:
		median_index = len(lst) - 1
	else:
		median_index = middle_index
	return median_index

def partition(lst, l, r):
	# Case 1: correct answer is 162085
	#p = lst[l] 
	
	# Case 2: correct anszer is 164123
	#p = lst[r]
	#lst[r], lst[l] = lst[l], lst[r]

	# Case 3: not 167663.
	m = find_median(lst)
	p = lst[m]
	lst[m], lst[l] = lst[l], lst[m]
	#print "median value: %s" % m

	global comparisons
	local_comparisons = (r - l)
	comparisons += local_comparisons
	#print "comparison count: %s" % local_comparisons
	#print "pivot: %s" % p


	i = l + 1
	for j in range(l + 1, r + 1):
		if lst[j] <= p:
			lst[j], lst[i] = lst[i], lst[j]
			i += 1
	lst[l], lst[i - 1] = lst[i - 1], lst[l]
	return i - 1


with open('numbers.json') as data_file:    
    data = json.load(data_file)
data8 = [3, 8, 2, 5, 4, 7, 6, 1]
data10 = [3, 9, 8, 4, 6, 10, 2, 5, 7, 1]
data100 = [57, 97, 17, 31, 54, 98, 87, 27, 89, 81, 18, 70, 3, 34, 63, 100, 46, 30, 99, 10, 33, 65, 96, 38, 48, 80, 95, 6, 16, 19, 56, 61, 1, 47, 12, 73, 49, 41, 37, 40, 59, 67, 93, 26, 75, 44, 58, 66, 8, 55, 94, 74, 83, 7, 15, 86, 42, 50, 5, 22, 90, 13, 69, 53, 43, 24, 92, 51, 23, 39, 78, 85, 4, 25, 52, 36, 60, 68, 9, 64, 79, 14, 45, 2, 77, 84, 11, 71, 35, 72, 28, 76, 82, 88, 32, 21, 20, 91, 62, 29]

#data = data10

quicksort(data, 0, len(data) - 1);
#pprint(data)
print "TOTAL COMPARISONS: %s" % comparisons

#median = find_median([3, 9, 8, 4, 6, 10, 2, 5, 7])
#print median