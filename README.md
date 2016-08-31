# ManiaDirect

Like ManiaLive, but Direct. 

## What

* Use Symfony components
* Do not reimplement what exists elsewhere
* Do not support legacy modes
* Make it testable
* put more facts here

## Questions

* Should we support multiple connections in a single instance?
  |-> it looks handy to make interaction between multiple server easier
      performances could be a problem. Maybe we should support threading out of the box? Is inter thread communication easy to in PHP?
* Should all plugin implements EventSubscriberInterface => is there any use for a plugin that does not listen to any events?
