import React from 'react';
import propTypes from 'prop-types';

class Marker extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            marker: null,
            openInfoWindow: false,
        };
    }
    componentDidMount() {
        if (this.props.map) {
            this.renderMarker();
        }
    }
    componentDidUpdate(prevProps) {
        if (this.props.map !== prevProps.map && !this.state.marker) {
            this.renderMarker();
        }
    }

    renderMarker() {
        const {google, map} = this.props;
        const config = {
            position: this.props.position,
            map: map,
        };

        const marker = new google.maps.Marker(config);
        marker.addListener('click', this.handleClick());

        this.setState({marker: marker});
    }

    handleClick() {
        return () => {
            this.setState({openInfoWindow: true})
        }
    }

    renderChildren() {
        const {children} = this.props;
        if (!children) return;

        return React.Children.map(children, child => {
            return React.cloneElement(child, {
                map: this.props.map,
                google: this.props.google,
                marker: this.state.marker,
                openInfoWindow: this.state.openInfoWindow,
            });
        })
    }

    render() {
        return (<div>{this.renderChildren()}</div>);
    };
}

Marker.propTypes = {
    position: propTypes.PropTypes.object,
    map: propTypes.PropTypes.object
};

export default Marker;