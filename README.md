# NML-Web-Interface

NML Web UI is a project designed to assist researchers in Nanomagnetic Logic, an area of research 
as replacment of traditional CMOS transistors.

This project consists of two primary components.

1. Web UI and Database backend which generate simulation files, and provide an API for the simulation
server to talk with.

2. Simulation server side Python connector script which reads from the host, starts the simulation
using OOMMF, and returns the results.

-------------------------------------------

########
WEB UI:
########

This layer is built on Lithium, a PHP framework for MVC development. More info at http://li3.me/

The MVC paradigm is vital to the structure of this web app. For development, MySQL has been the database
of choice, though Lithium should work with any system if configured correctly.

Next steps for the development of this component should be adding fields to the UI, and building out a model
and view for results that get posted from the simulation node.


########
SIMULATION NODE:
########

This is a relatively simple script that starts up a Python HTTP server and waits for a POST request from the 
WEB UI. Once it gets a request, it reads in the data from the API and generates files. Then it runs OOMMF,
using those generated files as input.

Next steps for the development of this component should be reading in the result files, parsing them, and POSTing
them back to the WEB UI.
