---
layout: post
title: "How Offline registry editing with Windows 7 saved my life (Kidding)"
date: 2011-11-08 22:58:08 +0530
categories: [tech]
tags: [tech]
---

Every time I install windows I find a new way to screw up things. In this process i also manage to learn something new. This time it was a kool issue which resulted in a deadlock.

Installed Win 7. The “Administrator” user is disabled during installation.

Created a user which had administrative privileges.

Changed the default ProfileListPath (HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows NT\CurrentVersion\ProfileList) registry key so that User data is stored on some other drive. (In this process did a typo in the ProfileListPath.

Created another user with Administrative privileges.

Changed the privileges of the user created in Step 2 to that of a Standard User.

Restarted the machine.

And then the fun begin. Windows wont allow the new administrative user to login into the system giving the “User profile could not be loaded” error due to the type in Step 3. As a result the machine had no user with administrative privileges. There was no way the registry key typo could be corrected within Windows.

OS Re installation was looking the only good option.  Some questions to Google god and it pointed me to the right direction – Offline Registry editing.

Offline registry editing means to edit the registry outside the Windows environment. Windows 7 has a super kool feature where you can go into repair mode  using your Installation DVD and execute the registry editor and actually edit the installed registry using the “Load Hive” option. This was a blessing for me.

Listed below are the steps which i performed

Loaded the hive where the key was present and corrected the typo.

Restarted the machine.

Logged into new user. (Voila! it worked)

Learned a bit about Windows 7 repair mode system tools as a result of this whole process and looking forward for more 😉
