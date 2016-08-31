# ManiaDirect

Like ManiaLive, but Direct. 

## What

* Use Symfony components
* Do not reimplement what exists elsewhere
* Do not support legacy modes
* Make it testable
* put more facts here

## Architecture

See `app/ManiaDirect.php` for entry point.
Core plugins are in `src/Core`. 

### Core plugins

* CallbackDispatcher (not finished): dispatch xmlrpc callback as events
* XmlrpcScriptCallbackDispatcher (not finished): dispatch xmlrpc script callbacks as events

## Questions

*  
* Should we support multiple connections in a single instance? Tt looks handy to make interaction between multiple server easier but performances could be a problem. Maybe we should support threading out of the box? Is inter thread communication easy to in PHP?
* Should all plugin implements EventSubscriberInterface => is there any use for a plugin that does not listen to any events?
