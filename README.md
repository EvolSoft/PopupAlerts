![start2](https://cloud.githubusercontent.com/assets/10303538/6315586/9463fa5c-ba06-11e4-8f30-ce7d8219c27d.png)

# PopupAlerts

A PocketMine-MP plugin that shows alerts in popups using CustomAlerts API

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP 1.7dev API 3.0.0-ALPHA7, 3.0.0-ALPHA8, 3.0.0-ALPHA9, 3.0.0-ALPHA10<br>
**Dependency Plugins:** CustomAlerts v1.8 API 2.0

## Overview

**PopupAlerts** is a CustomAlerts extension which allows you to show alerts (like join/leave messages, etc...) in popups!

**EvolSoft Website:** http://www.evolsoft.tk

***This Plugin is a CustomAlerts extension and uses CustomAlerts API 2.0. THIS MEANS THAT YOU NEED TO INSTALL CustomAlerts v1.8 PLUGIN TO USE PopupAlerts***

Messages can be configured simply from the CustomAlerts configuration file<br>
Please read the documentation to see how to configure PopupAlerts

## Donate

Support the development of this plugin with a small donation by clicking [:dollar: here](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=flavius.c.1999@gmail.com&lc=US&item_name=www.evolsoft.tk&no_note=0&cn=&curency_code=EUR&bn=PP-DonationsBF:btn_donateCC_LG.gif:NonHosted). Thank you :smile:

## Documentation 

**Configuration (config.yml):**

```yaml
---
#Message text must be configured from default CustomAlerts config.yml file
#Join messages
Join:
  #The duration of popup
  duration: 3
  #Show join messages in popups
  show-popup: true
  #Hide default join messages (they won't be displayed in chat but only on popups)
  hide-default: true
#Quit messages
Quit:
  #The duration of popup
  duration: 3
  #Show quit messages in popups
  show-popup: true
  #Hide default quit messages (they won't be displayed in chat but only on popups)
  hide-default: true
#World Change messages (they are displayed only if they are enabled in CustomAlerts configuration)
WorldChange:
  #The duration of popup
  duration: 3
  #Show world change messages in popups
  show-popup: true
  #Hide default world change messages (they won't be displayed in chat but only on popups)
  hide-default: true
#Death messages
Death:
  #The duration of popup
  duration: 3
  #Show death messages in popups (Remember that they can't be displayed from the victim)
  show-popup: true
  #Hide default death messages (they won't be displayed in chat but only on popups)
  hide-default: true
...
```
