# CGCU QR Ticket Manager

Disclaimer: This is not ready for public use. Development is at a stage where it is usable by me & is a work in progress.

#### Issues:
1. SQL Injection
Fix with http://php.net/manual/en/mysqli.quickstart.prepared-statements.php

2. Send-tickets password has been redacted for submission to git. Need to create a non-git INI file for it, or don't store and prompt for it every time.

#### To-Do List:
1. Set up logging?
2. Use union auth system
3. MySQL injection fixes
3. Restructure URL redirection
3. Send-tickets email system
    * Including QR code bug fix (PDF or embed image or both)
    * https://github.com/dompdf/dompdf
    * send tickets in the background, with progress bar
3. Add guest manually
3. Remove guest manually 
3. Plus1 solver
    * facility to allow two codes to be sent to the same person
    * facility for club email to get the +1's details to allocate tickets
3. CSP Side ticket swapping 
3. Ticket Holder ticket swapping
3. iOS Scanner app
3. pull attendees / events from eActivities 