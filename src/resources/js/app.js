import './bootstrap';
import createGlobe from "cobe";

let phi = 0;
let canvas = document.getElementById("cobe");

const globe = createGlobe(canvas, {
    devicePixelRatio: 2.3,
    width: 400 * 2,
    height: 400 * 2,
    phi: 0,
    theta: 0,
    dark: 1,
    diffuse: 1.5,
    mapSamples: 16000,
    mapBrightness: 60,
    baseColor: [0.3, 0.3, 0.3],
    markerColor: [1, 0, 0],
    glowColor: [1, 1, 1],
    markers: [
        // longitude latitude
        { location: [40.7128, -74.0060], size: 0.06 },  // New York, USA
        { location: [48.8566, 2.3522], size: 0.06 },    // Paris, France
        { location: [35.6895, 139.6917], size: 0.06 },  // Tokyo, Japan
        { location: [51.5074, -0.1278], size: 0.06 },   // London, UK
        { location: [34.0522, -118.2437], size: 0.06 }, // Los Angeles, USA
        { location: [55.7558, 37.6173], size: 0.06 },   // Moscow, Russia
        { location: [-33.8688, 151.2093], size: 0.06 }, // Sydney, Australia
        { location: [52.5200, 13.4050], size: 0.06 },   // Berlin, Germany
        { location: [-23.5505, -46.6333], size: 0.06 }, // São Paulo, Brazil
        { location: [19.4326, -99.1332], size: 0.06 },  // Mexico City, Mexico
        { location: [31.2304, 121.4737], size: 0.06 },  // Shanghai, China
        { location: [28.6139, 77.2090], size: 0.06 },   // Delhi, India
        { location: [37.7749, -122.4194], size: 0.06 }, // San Francisco, USA
        { location: [41.9028, 12.4964], size: 0.06 },   // Rome, Italy
        { location: [-1.2921, 36.8219], size: 0.06 },   // Nairobi, Kenya
        { location: [39.9042, 116.4074], size: 0.06 },  // Beijing, China
        { location: [-26.2041, 28.0473], size: 0.06 },  // Johannesburg, South Africaeee
        { location: [50.1109, 8.6821], size: 0.06 },    // Frankfurt, Germany
        { location: [41.3851, 2.1734], size: 0.06 },    // Barcelona, Spain
        { location: [35.6762, 139.6503], size: 0.06 }   // Tokyo, Japan
    ],
    onRender: (state) => {
        // Called on every animation frame.
        // `state` will be an empty object, return updated params.
        state.phi = phi;
        phi += 0.01;
    }
});