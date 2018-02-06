#!/bin/env python
# -*- coding: utf-8 -*-
import MeCab
import sys 
m = MeCab.Tagger("-Owakati")
strIn = " ".join(sys.argv[1:])
print m.parse(strIn)
