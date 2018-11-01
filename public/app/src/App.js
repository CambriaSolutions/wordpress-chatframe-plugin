import React, { Component } from 'react'
import Chatframe from '@cambriasolutions/chatframe'
import Avatar from '@cambriasolutions/chatframe/build/defaultavatar.9a557e734422142a75ba021171c25445.jpg'
const dfWebhookOptions = {
  eventUrl:
    'https://us-central1-dhcs-demo-chat.cloudfunctions.net/eventRequest',
  textUrl: 'https://us-central1-dhcs-demo-chat.cloudfunctions.net/textRequest',
}

class App extends Component {
  render() {
    return (
      <Chatframe
        avatar={Avatar}
        primaryColor="#3bafbf"
        secondaryColor="pink"
        title="Health Agency Virtual Assistant"
        client="Dialogflow"
        clientOptions={dfWebhookOptions}
        fullscreen={false}
        initialActive={false}
      />
    )
  }
}

export default App
