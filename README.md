idea behind the structure:

```
src/
    /Acme - application code
        /Bundle - contains one application bundle that integrates our application with framework. ONLY THESE CLASSES ARE AWARE
                  of the framework we are using.
        /Domain - domain code, business rules & PORTS definitions. These classes are NOT aware of the framework nor the infrastructure
        /Infrastructure - ADAPTERS implementations & classes that these implementations are using (dependencies of the adapters itself)
        /UseCase - use cases implementations. These are NOT aware of the infrastructure NOR framework
    /YourCompany - contains general libraries, not connected directly with the domain & our application (like log & cache libraries)
        /Bundle - symfony bundles that integrates the general-purpose libraries
        /Component - general-purpose libraries
```        
