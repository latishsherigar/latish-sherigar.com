---
layout: post
title: "Why is my app slow even on powerful hardware"
date: 2015-02-18 23:18:42 +0530
categories: [tech]
tags: [tech]
---

One of my job duties is to act as a performance tuning adviser for my company’s software product. My clients are product implementation teams who are facing performance issues with the product. One recent ‘complaint’ I received was that the software was performing poorly even on a server with 10 cores. His reasoning was simple – The server has many cores available so why does a application screen take 15 seconds to load. I had to explain him that this was a misconception on his part and it depended on the application code on how to utilize the extra cpu cores. A application which does not use any form of parallelism will execute all the logic serially even though they need not be. Such applications thus will be using only the single core of the machine.The remaining cores although ready for service are not utilized fully.

Application designers and developers need to take modern hardware into consideration when they are designing and writing software. If a unit of work can be made to execute in parallel safely it should be done.

So next time you have a application which shows the same performance on a desktop or an a server, you know the reason why.
