import React from 'react';
import Message from "./Message";

function ChatBody({ messages, user, friend }) {

    const messageElements = messages.map(message => (
        <Message key={message.id} message={message} user={user} friend={friend} />
    ));

    return (
        <ul className="chat">
            {messageElements}
        </ul>
    );
}

export default ChatBody;
