#!/bin/env python
# -*- coding: utf-8 -*-
from underthesea import word_tokenize
import sys
strIn = " ".join(sys.argv[1:])
print (word_tokenize(strIn, format="text"))