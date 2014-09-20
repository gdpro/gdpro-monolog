Monolog Documentation
=====================

Default Logger
--------------
<code php>
    $this->getServiceLocator()->get('gdpro-monolog_default')->addDebug('hello world');
</code>


Exception Logger
--------------
<code php>
    $this->getServiceLocator()->get('my_awesome_customized_logger')->addDebug('hello world');
</code>

