import sys
from sys import stdout, stderr, stdin
from collections import Counter

alphabet = {chr(i+65):i for i in range(0,26)}
class AChecker:
    def __init__(self, words=[], phrase=""):
        super(AChecker, self).__init__()
        self.words = [word.upper() for word in words]
        self.phrase = phrase.upper()
        self.wordsCounter = {word: self.createCounter(word) for word in self.words}
        self.phraseCounter = self.createCounter(self.phrase)
        
        self.results = []

    def createCounter(self, word):
        result = [0]*26
        for i in word:
            if i in alphabet:
                index = alphabet[i]
                result[index] += 1
        return result

    def remove(self, word):
        word = word.upper()
        self.phraseCounter = [self.phraseCounter[i] - self.wordsCounter[word][i] for i in range(0,26)]

    def add(self, word):
        word = word.upper()
        self.phraseCounter = [self.phraseCounter[i] + self.wordsCounter[word][i] for i in range(0,26)]

    def consist(self, word):
        word = word.upper()
        for i in range(0,26):
            if self.phraseCounter[i] < self.wordsCounter[word][i]:
                return False
        return True

    def contain(self, word): 
        word = word.upper()
        return word in self.phrase.split()

    def save(self, anagram):
        self.results.append(anagram)    

def Combination(arr, data, start, end, index, r, phrase):
    check = AChecker(arr, phrase)
    if (index == r):
        path = []
        for j in range(r):
            path.append(data[j])
            check.remove(data[j])
        for j in range(len(check.phraseCounter)):
            if (check.phraseCounter[j]) == 0:
                status = True
            else:
                status = False
                break
        if status == True:
            print(phrase,"= ",end="")
            for x in range(len(path)):
                print(path[x],end=" ")
            print("")
        return
    i = start
    while(i <= end and end - i + 1 >= r - index): 
        data[index] = arr[i]
        Combination(arr, data, i + 1, end, index + 1, r, phrase)
        i += 1

def Solve(*args):
    params = locals()['args']
    words, phrase = params
    checker = AChecker(words, phrase)
    path = []
    for i in range(len(words)):
        if checker.consist(words[i]) == True and checker.contain(words[i]) == False:
            path.append(words[i])
    
    for i in range(len(path)):
        data = [0]*(i+1)
        Combination(path, data, 0, len(path) - 1, 0, i+1, phrase)


def main():
    try:
        # Contoh Perbedaan Contain dan Consist:
        # kamus = ["anja", "barbar", "belanja", "sabar"]
        # frasa = "Budi belanja di pasar"
        # checker = AChecker(kamus, frasa)
        ## -------------------------------------------
        # print(checker.consist("sabar")) # Bernilai True
        # print(checker.consist("barbar")) # Bernilai False
        ## --------------------------------------------
        # print(checker.contain("belanja")) # Bernilai True
        # print(checker.contain("sabar")) # Bernilai False
        ## --------------------------------------------
        # checker.remove("belanja") # Menghapus kata belanja dari "counter frasa"
        # checker.add("belanja") # Menambahkan kembali kata belanja kedalam "counter frasa"
        words = []
        phrases = []
        while(True):
            line = next(inp).strip()
            if line == "#":
                break
            words.append(line)
            
        while(True):
            line = next(inp).strip()
            if line == "#":
                break
            result = Solve(words, line)
            if result != None:
                print(result)
            
    except:
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
