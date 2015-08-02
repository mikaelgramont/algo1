# From http://stackoverflow.com/questions/23825200/karger-min-cut-algorithm-in-python-2-7

import random, copy, pprint
data = open("kargerMinCut.txt","r")
#data = open("sample.txt","r")
G = {}
for line in data:
    lst = [int(s) for s in line.split()]
    G[lst[0]] = lst[1:]   

def choose_random_key(G):
    v1 = random.choice(list(G.keys()))
    v2 = random.choice(list(G[v1]))
    return v1, v2

def karger(G):
    length = []
    while len(G) > 2:
        v1, v2 = choose_random_key(G)
        # All edges pointing to v2 must now point to v1.
        G[v1].extend(G[v2])
        for x in G[v2]:
            # All references to v2 must be removed and replaced with v1.
            G[x].remove(v2)
            # This is key: we will have duplicate entries for v1 in a sublist,
            # they represent the number of parallel edges, which will
            # eventually represent the number of min cuts.
            G[x].append(v1) 
        while v1 in G[v1]:
            # Remove self loops.
            G[v1].remove(v1)
        # Remove v2 altogether.
        del G[v2]
    # We're done reducing the graph to 2 vertices.
    for key in G.keys():
        # Return the number of edges in the first entry
        # (it would be the same in the second one).
        length.append(len(G[key]))
    return length[0]

def operation(n):
    i = 0
    count = 10000   
    while i < n:
        data = copy.deepcopy(G)
        min_cut = karger(data)
        print "iteration %i: %i" % (i, min_cut)
        if min_cut < count:
            count = min_cut
        i = i + 1
    return count


print(operation(100))