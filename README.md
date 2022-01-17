# Php Ftp Toolbox
Simple php tools for extracting data and files directly from a server.
The tools are very basic, but from time to time you just need a tool,
and then it is good to have it in the toolbox.

## dlstart.php
Downloader. Eines der Haupttools.
Kann verwendet werden, um komplette Ordnerstrukturen rekursiv von einem Server zu kopieren.
Einfach einen Ordnerpfad auf dem Server angeben, das Tool arbeitet sich anschließend durch alle Dateien auf dem Server und lädt sie herunter.

Eine FTP Konfiguration kann über die Datei dlconf angegeben werden.

Zu diesem Tool gehören folgende Dateien:

* dlstart.php
* dlconf.php (Konfiguration)
* dl.php (Wird aufgerufen, um eine einzelne Datei herunterzuladen)
* dl.js

## glo.php / glodl.php

Gibt alle Dateien innerhalb eines Ordnerpfades aus.

* Die erzeugte Datei kann verwendet werden, um anschließend mit Hilfe von glodl.php die Dateien herunterzuladen.
* glodl.php muss dabei auf dem Rechner ausgeführt werden, der die Daten empfangen soll. 
* Die Daten werden als HTTP Downloads heruntergeladen.

## Minimum Shopware 5 Plugin

Für die Datenrettung aus ansonsten abgeschirmten Projekten kann dieses Minimum-Shopware Plugin verwendet werden.
Einfach die weiteren Anwendungen mit hineinpacken. Die Scripte sind später direkt abrufbar,
womit auch solche Anwendungen gerettet werden können, die über keinen FTP-Zugang mehr verfügen.

