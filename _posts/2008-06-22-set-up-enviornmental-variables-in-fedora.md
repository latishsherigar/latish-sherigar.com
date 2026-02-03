---
layout: post
title: "Set up Enviornmental variables in Fedora"
date: 2008-06-22 02:50:35 +0530
categories: [tech]
tags: [tech]
---

You can easily set up environmental variables which needs to be available globally for all your applications. This can be done by placing scripts in the /etc/profile.d directory which are executed every time a shell instance is being created.

Example: To set JAVA_HOME environmental variable so that it points to where you have installed java, you can either create a new shell script or edit an existing shell script in the profile.d directory. Type in the follwoing line and save it as java.sh in the directory

JAVA_HOME=/usr/java/latest

You are done. Now every application will know where you have installed java. Now that is one of the easiest things you could do in Linux 🙂
