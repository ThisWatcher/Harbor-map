import React from 'react';

class InfoWindowContent extends React.Component {
    render() {
        const weather = this.props.weather;

        return (
            <div>
                {this.props.image &&
                    <img src={this.props.image} alt={this.props.name} style={{ maxWidth: 100 + '%', maxHeight: 50 + 'px' }}/>
                }
                <h2>{this.props.name}</h2>
                {weather &&
                    <div>
                        <strong>Weather: </strong>
                        {weather.place}: {weather.temperature}°C. Feels like {weather.heat_index}°C.
                        Wind speed up to {weather.wind_speed} km/h.
                        {weather.description}.
                        <div>
                            <i>weather Provided by: {weather.weather_provider}</i>
                        </div>
                    </div>
                }
            </div>
        );
    }
}

export default InfoWindowContent;