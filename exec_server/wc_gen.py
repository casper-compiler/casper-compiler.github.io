#Punjab Lahore Awesome 5 true
#Punjab Islamabad Okay 3 true
#Sindh Karachi Good 4 false
#Sindh Karachi Great 4 true

import random

words = ["computer","network","software","program","card","engineer","design","visualization","verification",
"the","of","Microsoft","Adobe","image","processing","big","data","gadget","faster",
"internet","Google","research","free","books","food","game","speaker","monitor","keyboard",
"mouse","RAM","CPU","HDD","cable","printer","very","and","is","are"]

fh = open("words.txt","w")

for i in range(100000):
	for j in range(500): 
		fh.write(random.choice(words))
		if j != 99:
			fh.write(" ")
		else:
			fh.write("\n");
