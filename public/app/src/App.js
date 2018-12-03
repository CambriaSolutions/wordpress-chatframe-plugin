import React, { Component } from 'react'
import Chatframe from '@cambriasolutions/chatframe'

const dfWebhookOptions = {
  eventUrl:
    'https://us-central1-dhcs-demo-chat.cloudfunctions.net/eventRequest',
  textUrl: 'https://us-central1-dhcs-demo-chat.cloudfunctions.net/textRequest',
}

class App extends Component {
  render() {
    return (
      <Chatframe
        primaryColor="#3bafbf"
        secondaryColor="#3bafbf"
        title="Gen"
        client="Dialogflow"
        clientOptions={dfWebhookOptions}
        fullscreen={false}
        initialActive={false}
      />
    )
  }
}

export default App
