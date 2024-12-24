import json
with open("./data/geodata.geojson", encoding="utf8") as f:
    data = json.load(f)

for district in data["features"]:
    for coordinate in district["geometry"]["coordinates"]:
        for subdiv in coordinate:
            temp = subdiv[0]
            subdiv[0] = subdiv[1]
            subdiv[1] = temp

with open("./data/optimiseddata.geojson", "w") as outfile:
    json.dump(data, outfile, indent=1)



