<?php

return <<<TEMPLATE
import React, {Component} from 'react';
import './{$componentName}.css';

class {$componentName} extends Component {
    render() {
        return (

        );
    }
}

export default {$componentName};
TEMPLATE;
