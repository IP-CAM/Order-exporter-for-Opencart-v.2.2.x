#!/bin/bash

rm rm-order-exporter.ocmod.zip

# Replace modifycation ID
sed "s/<code>.*<\/code>/<code><\!\[CDATA\[`git rev-parse HEAD`\]\]><\/code>/g" install.xml.tpl > install.xml

zip rm-order-exporter.ocmod.zip \
    install.xml \
    LICENSE \
    README.md \
    -r upload

rm install.xml
