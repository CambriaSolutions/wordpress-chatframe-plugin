import React, { Component } from 'react'
import Chatframe from '@cambriasolutions/chatframe'

const dfWebhookOptions = {
  eventUrl: 'https://us-central1-mdhs-csa.cloudfunctions.net/eventRequest',
  textUrl: 'https://us-central1-mdhs-csa.cloudfunctions.net/textRequest',
}

const policyText =
  'Please do not enter any personally identifiable information such as SSN or Date of Birth'

const feedbackUrl =
  'https://us-central1-webchat-analytics.cloudfunctions.net/storeFeedback'

export const mapConfig = {
  googleMapsKey: process.env.REACT_APP_GOOGLE_MAPS_KEY,
  centerCoordinates: {
    lat: 32.777025,
    lng: -89.543724,
  },
}

export const activationText = 'Talk to Gen'

const defaultOpenPages = []

const currentUrlPath = window.location.pathname
let initialActive = false
defaultOpenPages.forEach(page => {
  if (currentUrlPath && currentUrlPath.includes(page)) {
    initialActive = true
  }
})

class App extends Component {
  render() {
    return (
      <Chatframe
        primaryColor='#6497AD'
        secondaryColor='#6497AD'
        headerColor='#6497AD'
        title='Gen'
        client='Dialogflow'
        clientOptions={dfWebhookOptions}
        fullscreen={false}
        initialActive={initialActive}
        policyText={policyText}
        mapConfig={mapConfig}
        feedbackUrl={feedbackUrl}
        activationText={activationText}
      />
    )
  }
}

export default App
