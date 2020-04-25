import React from 'react';
import propTypes from 'prop-types';

class InfoWindow extends React.Component {
    componentDidUpdate(prevProps) {
        if (this.props.openInfoWindow) {
            this.renderInfoWindow();
        }
    }

    async renderInfoWindow() {
        if (!this.props.infoWindowContent) {
            return
        }
        let {map, google, marker} = this.props;
        const content = await this.props.infoWindowContent(this.props);

        this.infowindow = new google.maps.InfoWindow({
            content: content
        });
        this.infowindow.open(map, marker);
    }

    render() {
        return null;
    }
}

InfoWindow.propTypes = {
    content: propTypes.PropTypes.string,
};

export default InfoWindow;