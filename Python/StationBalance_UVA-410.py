import sys
from sys import stdout, stderr, stdin

def changeLineToIntArray(line):
    arr = line.split()
    return [int(i) for i in arr]

def Solve(*args):
    params = locals()['args']
    c = params[0]
    s = params[1]
    specimens = []
    imbalance = 0
    total = 0
    result = ""
    for i in range(c*2):
        if i < s:
            specimens.append(params[2][i])
            total += params[2][i]
        else:
            specimens.append(0)
    rata = total/c
    specimens.sort()
    index = params[3]
    result += "Set #{0}\n".format(index)
    for i in range(c):
        result += " {0}:".format(i)
        if specimens[i] != 0 and specimens[len(specimens)-i-1] != 0:
            result += " {0} {1}\n".format(specimens[i],specimens[len(specimens)-i-1])
        elif specimens[i] != 0 and specimens[len(specimens)-i-1] == 0:
            result += " {0}\n".format(specimens[i])
        elif specimens[i] == 0 and specimens[len(specimens)-i-1] != 0:
            result += " {0}\n".format(specimens[len(specimens)-i-1])
        else:
            result += "\n"
        if (specimens[i]+specimens[len(specimens)-i-1]) > rata:
            imbalance += (specimens[i]+specimens[len(specimens)-i-1]) - rata
        else:
            imbalance += rata - (specimens[i]+specimens[len(specimens)-i-1])
    result += "IMBALANCE = {:.5f}".format(imbalance)
    return result
        



def main():
    try:
        idx = 0
        while(True):
            firstLine = next(inp).strip()
            C, S = changeLineToIntArray(firstLine)

            secondLine = next(inp).strip()
            specimens = changeLineToIntArray(secondLine)
            
            idx += 1
            print(Solve(C, S, specimens, idx))             
            print()
    except:
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
