from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
import math, os
import numpy as np
# ini untuk pemisahan kata


def Tokenizing(namafile):
    f = []
    f = open(namafile)
    kalimat = f.read().lower().strip()
    tokens = kalimat.split()
    return tokens

# # ini untuk penghapusan kata yang tidak penting


def Filtering(tokens):
    filtered = []
    f = open("stopword.txt")
    stopwords = f.read().splitlines()
    for t in tokens:
        if t not in stopwords:
            filtered.append(t)
    f.close()
    return filtered

# # ini untuk pembentukan kata ke kata dasar


def Stemming(filtered):
    hasilStem = []
    factory = StemmerFactory()
    stemmer = factory.create_stemmer()
    for sf in filtered:
        hasilStem.append(stemmer.stem(sf))
    return hasilStem


# main program start here
# ======================================================================================

# get queries
qr_finale = "temp.txt"
qr_token = Tokenizing(qr_finale)
qr_filter = Filtering(qr_token)
qr_finale = Stemming(qr_filter)

print("Token : ")
print(qr_token)

print("Filter : ")
print(qr_filter)

print("Stemming : ")
print(qr_finale)
