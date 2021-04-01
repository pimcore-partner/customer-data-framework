# Update Notices

## Update to Version 3
- Activate `Generate Type Declarations` for all classes generated/used by the Customer Management Framework:
  - `Customer`
  - `CustomerSegment`
  - `SsoIdentity`
- `FilterHandler::addFilter` as not operator as parameter anymore (as this was only considered with `SearchQuery` filters). 
  Use new `BoolanCombinator` for combining multiple filters with OR operator instead. 
- Migrate all templates to twig.
- `AbstractObjectActivity::toArray` and GDPR exporter results might be different, as it utilizes new `normalize` methods 
  instead of deprecated `getDataForWebservice` methods.
- Webservices URLs changed to ` /__customermanagementframework/webservice/*`
- Add following line to your firewalls configuration in the `security.yml` of your app after the `pimcore_admin` firewall.
```yml 
security:
    firewalls:
        pimcore_admin: 
            # ...
        cmf_webservice: '%customer_management_framework.firewall_settings%'
``` 

### Removed features in Version 3   
- Removed `SegmentTrackedListener` for tracking tracked segments into Piwik/Matomo
  (as matomo integration is deprecated in Pimcore 6.9 and removed in Pimcore X).
- Migrated all templates to php templates and removed templating helpers.

## Update to Pimcore X
- Update to Pimcore 6.9.
- Update Customer Management Framework to latest version (compatible to Pimcore 6.9).
- Execute all migrations of Customer Management Framework.
- Update to Pimcore X.