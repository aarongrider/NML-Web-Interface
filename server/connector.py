#####################################
# Connector.py
# Client connector to OOMMF Web UI
#####################################

#!/usr/bin/env python

############ IMPORTS
from http.server import BaseHTTPRequestHandler, HTTPServer
import urllib
import urllib.request
import json
import time

############ METHODS
def startSimulation(id):
	# Create files
	generateFiles(id)

	# Start OOMMF with files

	# Return Data to Web UI

	print("Simulation finished starting")

def generateFiles(id):
	print("Generating files")
	
	# Read from API
	api_url = "http://ubuntu.local/simulation/api/" + id + ".json"
	response = urllib.request.urlopen(api_url)
	data = json.loads(response.readall().decode('utf-8'))

	# Write data to files
	for output in data['outputs']:
		filename = "simulaton"
		fo = open(filename + "." + output, "w")
		fo.write(data['outputs'][output])
		fo.close()

def startOOMMF():
	print("Starting OOMMF")

############ WEB SERVICE
hostName = "72.233.176.25"
hostPort = 9000

class ConnectorServer(BaseHTTPRequestHandler):
	def do_GET(self):
		self.send_response(200)
		self.send_header("Content-type", "text/html")
		self.end_headers()
		self.wfile.write(bytes("<html><head><title>ConnectorServer</title></head>", "utf-8"))
		self.wfile.write(bytes("<body><p>ConnectorServer is running</p>", "utf-8"))
		self.wfile.write(bytes("<p>You accessed path: %s</p>" % self.path, "utf-8"))
		self.wfile.write(bytes("</body></html>", "utf-8"))

	def do_POST(self):
		self.send_response(200)
		self.send_header("Content-type", "text/html")
		self.end_headers()

		length = int(self.headers['Content-Length'])

		# Get dictionary of the post data
		post_data = urllib.parse.parse_qs(self.rfile.read(length).decode('utf-8'))
		item_id = post_data['id'][0]
		print("Item ID: " + item_id)

		startSimulation(item_id)

		#write_data = "Item: " + item_id + " started"
		self.wfile.write(item_id.encode("utf-8"))

ConnectorServer = HTTPServer((hostName, hostPort), ConnectorServer)
print(time.asctime(), "ConnectorServer started - %s:%s" % (hostName, hostPort))

try:
	ConnectorServer.serve_forever()
except KeyboardInterrupt:
	pass

ConnectorServer.server_close()
print(time.asctime(), "ConnectorServer Stopped - %s:%s" % (hostName, hostPort))