import React from 'react';
import Map from './Map';
import Marker from './Marker';
import InfoWindow from './InfoWindow';
import InfoWindowContent from './InfoWindowContent';
import ReactDOMServer from 'react-dom/server';
import axios from "axios";

const weatherProviderUrl = 'https://api.openweathermap.org/data/2.5/';
const harborProviderUrl = 'https://devapi.harba.co';
const googleMapsUrl = 'https://maps.googleapis.com/maps/api/js';

class Home extends React.Component {
    constructor() {
        super();
        this.state = {
            harbors: [],
        };
        this.getInfoWindowContent = this.getInfoWindowContent.bind(this);
    }

    componentDidMount() {
        this.getHarbors();
        this.getGoogleMaps();
    }

    getGoogleMaps() {
        const script = document.createElement('script');
        script.src = googleMapsUrl;
        script.async = true;
        script.defer = true;
        script.addEventListener('load', () => {
            this.setState({ google: window.google });
        });
        document.head.appendChild(script);
    }

    getHarbors() {
        axios.get(`/api/harbors`)
            .then(harbors => {
            this.setState({ harbors: harbors.data});
        })
    }

    getWeather(lat, lon) {
        return axios.get(`/api/weather`, {
            params: {
                lat: lat,
                lon: lon
            }
        }).then(response => {
            return response.data.message;
        })
    }

    async getInfoWindowContent(props) {
        const weather = await this.getWeather(props.data.lat, props.data.lon);
        const InfoWindowContentProps = {
            name: props.data.name,
            imageHost: harborProviderUrl,
            imagePath: props.data.image,
            weather: weather,
            weatherProvider: weatherProviderUrl
        };
        const element = React.createElement(InfoWindowContent, InfoWindowContentProps);
        return ReactDOMServer.renderToStaticMarkup(element);
    }

    render() {
        const style = {
            width: '100vw',
            height: '100vh'
        };

        const markers = this.state.harbors.map((harbor, i) => {
            const position = {lat: parseInt(harbor.lat), lng: parseInt(harbor.lon)};
            return (
                <Marker key={i} position={position}>
                    <InfoWindow
                        data={harbor}
                        infoWindowContent={this.getInfoWindowContent}
                        key={i}>
                    </InfoWindow>
                </Marker>)
        });

        return (
            <div style={style}>
                <Map google={this.state.google}>
                    {markers}
                </Map>
            </div>
        )
    }
}

export default Home;