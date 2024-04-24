<?php

return <<<TEMPLATE
import React, {Component} from 'react';
import { connect } from "react-redux";

class {$componentName} extends Component
{
    static mapStateToProps(state, props) {
        return props;
    };

    render() 
    {
        return (

        );
    }
}

export default connect($componentName.mapStateToProps, {})($componentName);
TEMPLATE;
