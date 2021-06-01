import React, { useState, useEffect } from 'react';
import ChatBody from "./ChatBody";
import ChatForm from "./ChatForm";

function ChatContainer() {
    const [ messages, setMessages ] = useState([]);
    const [ user, setUser ] = useState(null);
    const [ friend, setFriend ] = useState(null);

    let apiUrl = new URL(window.location);
    apiUrl.pathname = '/api' + apiUrl.pathname;

    useEffect(() => {
        fetch(apiUrl.href)
            .then(response => response.json())
            .then(data => {
                setUser(data.user);
                setFriend(data.friend);
                setMessages(data.messages);
            });
    }, []);

    useEffect(() => {
        const chatBody = document.getElementById('chat-body');
        chatBody.scrollTop = chatBody.scrollHeight;
    }, [messages])

    const handleSend = (message, file) => {
        let body = new FormData();
        body.append('message', message);
        body.append('file', file);

        fetch(apiUrl.href, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: body
        })
            .then(response => response.json())
            .then(data => {
                setMessages([...messages, data]);
            });
    }

    return (
        <div className="container">
            <div className="row">
                <div className="col-md-8 col-md-offset-2">
                    <div className="panel panel-default">
                        <div className="panel-heading">Chat</div>

                        <div className="panel-body" id="chat-body">
                            <ChatBody messages={messages} user={user} friend={friend} />
                        </div>
                        <div className="panel-footer">
                            <ChatForm onMessageSubmit={ handleSend } />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ChatContainer;
