#!/bin/bash
user='sample_user'
psswd='PASSWORD'
database='sample_store'
script='/home/pjmd/PhpWorkspace/Intro/sample-sore/sample_store.sql'

mysql -h localhost -u $user --password=$psswd $database < $script