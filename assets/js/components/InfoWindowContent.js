import React from 'react';

class InfoWindowContent extends React.Component {
    render() {
        const imageHost = this.props.imageHost;
        const imageUrl = this.props.imagePath ? imageHost.concat(this.props.imagePath) : null;
        return (
            <div>
                {imageUrl &&
                    <img src={imageUrl} alt={this.props.name} style={{ maxWidth: 100 + '%', maxHeight: 50 + 'px' }}/>
                }
                <h2>{this.props.name}</h2>
                <div>
                    <strong>Weather: </strong>
                    {this.props.weather}
                    <div>
                        <i>weather Provided by: {this.props.weatherProvider}</i>
                    </div>
                </div>
            </div>
        );
    }
}

export default InfoWindowContent;