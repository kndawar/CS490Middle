  a=a
    string = x
    index = len(string)
    mirroredString = ""
    for i in string:
        mirroredString += string[(index-1)]
        index = index-1
    return (string+mirroredString)
print(makePalindro("no",))