class matrix:
    def __init__(self, dims=4):
        super(matrix, self).__init__()
        self.rows = self.cols = self.dims = dims
        self.value = [[1] * self.cols for i in range(self.rows)]

    def __add__(self, B):
        if self.rows != B.rows or self.cols != B.cols:
            raise ValueError("Rows dan Cols harus sama")
        C = matrix(self.dims)
        C.value = [[self.value[j][i] + B.value[j][i] for i in range(self.cols)] for j in range(self.rows)]
        return C

    def __sub__(self, B):
        if self.rows != B.rows or self.cols != B.cols:
            raise ValueError("Rows dan Cols harus sama")
        C = matrix(self.dims)
        C.value = [[self.value[j][i] - B.value[j][i] for i in range(self.cols)] for j in range(self.rows)]
        return C

    def __str__(self): 
        rows = len(self.value)
        mtxStr = ''     
        for i in range(rows):
            mtxStr += (','.join( map(lambda x:'{0:8.3f}'.format(x), self.value[i])) + '\n')
        return mtxStr

    def split(self):
        if not ((self.dims & (self.dims - 1) == 0) and self.dims != 0):
            raise ValueError("Rows dan Cols bukan hasil pemangkatan dari 2")
        N = self.dims // 2
        
        A = matrix(N)
        B = matrix(N)
        C = matrix(N)
        D = matrix(N)
        
        a = self.value[:N]
        b = self.value[:N]
        c = self.value[N:]
        d = self.value[N:]

        for i in range(N):
            a[i] = a[i][:N]
            b[i] = b[i][N:]
            c[i] = c[i][:N]
            d[i] = d[i][N:]

        A.value = a
        B.value = b
        C.value = c
        D.value = d

        return A, B, C, D

    @staticmethod
    def combine(a11,a12,a21,a22):
        N = a11.dims
        a = matrix(N*2)
        for i in range(N):
            for j in range(N):
                a.value[i][j] = a11.value[i][j]
                a.value[i][j+N] = a12.value[i][j]
                a.value[i+N][j] = a21.value[i][j]
                a.value[i+N][j+N] = a22.value[i][j]
        return a

A = matrix()
B = matrix()

A.value = [[3,4,8,16],[21,5,12,10],[5,1,2,3],[45,9,0,-1]]
B.value = [[5,4,3,8],[12,10,5,15],[8,3,2,1],[20,10,5,7]]


def Starssen(A,B):
    if (A.dims == 1):
        C = matrix(A.dims)
        C.value = [[A.value[0][0] * B.value[0][0]]]
        return C
    else: 
        a11, a12, a21, a22 = A.split()
        b11, b12, b21, b22 = B.split()
        
        m1 = matrix(a11.dims)
        m2 = matrix(a11.dims)
        m3 = matrix(a11.dims)
        m4 = matrix(a11.dims)
        m5 = matrix(a11.dims)
        m6 = matrix(a11.dims)
        m7 = matrix(a11.dims)

        m1 = Starssen((a12.__sub__(a22)),(b21.__add__(b22)))
        m2 = Starssen((a11.__add__(a22)),(b11.__add__(b22)))
        m3 = Starssen((a11.__sub__(a21)),(b11.__add__(b12)))
        m4 = Starssen((a11.__add__(a12)),b22)
        m5 = Starssen(a11,(b12.__sub__(b22)))
        m6 = Starssen(a22,(b21.__sub__(b11)))
        m7 = Starssen((a21.__add__(a22)),b11)
        
        c11 = matrix(a11.dims)
        c12 = matrix(a11.dims)
        c21 = matrix(a11.dims)
        c22 = matrix(a11.dims)
        
        c11 = ((m1.__add__(m2)).__sub__(m4)).__add__(m6)
        c12 = m4.__add__(m5)
        c21 = m6.__add__(m7)
        c22 = ((m2.__sub__(m3)).__add__(m5)).__sub__(m7)
        
        return matrix().combine(c11,c12,c21,c22)

print(Starssen(A,B))
