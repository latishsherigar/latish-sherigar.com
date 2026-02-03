---
layout: post
title: "Browsers and http session keep alives"
date: 2016-07-08 20:06:52 +0530
categories: [tech]
tags: [tech]
---

Recently came across a situation when I found out that Chrome and Internet explorer behave differently in case of http session keep alive’s. The behaviour observed was that Internet explorer closes a connection after a fixed interval whereas Chrome keeps the connection alive for a longer duration.

When a web page is requested, the browser downloads the required page along with other components.  If the server wants the http/https session to be kept alive, IE will keep the connection open TILL its own timeout limit . The default is 1 minute. After this the browser has to open a new http/https connection in case there is a need. Chrome on the other hand keeps the connection alive by sending a TCP keep alive packet 45 seconds after the last http session request.

When a connection is kept alive, the server would keep the port and its related resources like threads/memory on the server longer. Whenever a new connection is made, it requires a handshake to be done between the browser and the server where they speak on which port would they use, which protocol etc. While this may be light handshake for a http session, https means they need to talk about security certificates and the encryption keys which means a lot more talking. The user has wait till this talking is done and his webpage displayed or banking transaction is completed. With low powered mobiles which have a less number of CPU cores, low RAM or a poor network connection this might not be a pleasant experience. This would also mean the battery drains faster as the CPU has to do extra work.

Chrome therefore could be keeping the connection alive so that end user has a better user experience even though it puts some extra load on the server.

While it seems obvious that it should be the default behaviour, there may a reason why IE behaves this way. For a long time, IE has the browser which has the largest installed user base. With longer keep alives, servers would need to keep extra resources to support those users. With increased processing power at the desktops along with faster internet bandwidth, reconnecting a disconnected http/https session would not be so costly as was earlier with low power CPU/ low RAM and low network bandwidth. Disconnecting a minute after the last request was made sounds a reasonable design decision.
