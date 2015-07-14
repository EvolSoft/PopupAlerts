![start2](https://cloud.githubusercontent.com/assets/10303538/6315586/9463fa5c-ba06-11e4-8f30-ce7d8219c27d.png)

# PopupAlerts
A PocketMine-MP plugin to show alerts in popups using CustomAlertsAPI

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP Alpha_1.5 API 1.12.0<br>
**Dependency Plugins:** CustomAlerts v1.6 API 1.2

## Overview

**PopupAlerts** is a CustomAlerts extension which allows you to show alerts (like join/leave messages, etc...) in popups!

**EvolSoft Website:** http://www.evolsoft.tk


***This Plugin uses PocketMine 1.5 API. You can't install it on old versions of PocketMine and this plugin works only with MCPE v0.11.0 and later.***<br>
***This Plugin is a CustomAlerts extension and uses CustomAlerts API 1.2. THIS MEANS THAT YOU NEED TO INSTALL CustomAlerts v1.6 PLUGIN TO USE PopupAlerts***

Messages can be configured simply from default CustomAlerts config.yml<br>
Please read the documentation to see how to configure PopupAlerts

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
