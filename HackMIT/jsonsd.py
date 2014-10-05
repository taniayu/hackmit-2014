import json
import csv
import MySQLdb
from pprint import pprint
db = MySQLdb.connect(host="localhost", user="root", passwd="hackmit", db="yelp")
cur = db.cursor()
cur.execute("SELECT businessid FROM business WHERE names = 'Bookstar' %s", var)
print cur
            
json_data=open('merged_yelp_academic_dataset_business.json')
data = json.load(json_data)
bsnslist = []
namelist = []
for x in data:
    bsnslist.append(x['business_id'] + ";" + x['name'] + ";" + x['city'])
    #namelist.append(x['name'])
    newdat = {"business_id" :bsnslist}
    #namedat = {"name": namelist}
#mylist = [newdat, namedat]

#pprint(bsnslist)
##with open('result.json', 'w') as fp:
##    json.dump(newdat, fp)

"""with open("output.csv", 'w') as output:
    writer = csv.writer(output, lineterminator='\n')
    for y in bsnslist:
        writer.writerow([y])"""
##writer = csv.writer(open("output.csv", "wb"))
##for y in range(len(bsnslist)):
##    writer.writerow(bsnslist[y])

json_data.close()
