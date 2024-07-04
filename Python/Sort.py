def sort_array(cba):
    for aab in range (1,len(cba)):
        baa = cba[aab]
        aba = aab-1
        while aba >= 0 and int(baa) > int(cba[aba]):
            cba[aba+1] = cba[aba]
            aba -= 1
            print(cba)
        cba[aba+1] = baa
        print(cba)
    return cba

def main():
    print("Pencari Bilangan Prima")
    print("Array yang ingin di sort (pisahkan angka dengan spasi)")
    cba = input("Array : ").split()
    print(sort_array(cba))

if __name__ == '__main__':
    main()