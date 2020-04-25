import React from 'react';
import propTypes from "prop-types";

class Map extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            map: null,
        };
    }
    componentDidMount() {
        if (this.props.google) {
           this.loadMap();
        }
    }

    componentDidUpdate(prevProps) {
        //if (this.props.google && !this.map) {
        if (this.props.google !== prevProps.google) {
            this.loadMap();
        }
    }

    loadMap() {
        const {google} = this.props;
        const maps = google.maps;

        const node = document.getElementById('map');

        const mapConfig = Object.assign({}, {
            center: {lat: 50, lng: 50},
            zoom: 2,
        });

        const map = new maps.Map(node, mapConfig);
        this.setState({map: map})
    }

    renderChildren() {
        const {children} = this.props;
        if (!children) return;

        return React.Children.map(children, child => {
            return React.cloneElement(child, {
                map: this.state.map,
                google: this.props.google
            });
        })
    }

    render() {
        return (
            <div id="map">
                Loading map...
                {this.renderChildren()}
            </div>
        );
    }
}

Map.propTypes = {
    center: propTypes.PropTypes.object,
    zoom: propTypes.PropTypes.number
};

export default Map;