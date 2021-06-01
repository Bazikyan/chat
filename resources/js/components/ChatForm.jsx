import React, { useState } from 'react';

function ChatForm({ onMessageSubmit }) {
    const [ message, setMessage ] = useState('');
    const [ file, setFile ] = useState(null);

    const handleChange = (event) => {
        setMessage(event.target.value);
    }

    const handleKeyPress = (event) => {
        if (event.key === 'Enter') {
            handleSubmit();
        }
    }

    const handleFileUpload = (event) => {
        setFile(event.target.files[0]);
    }

    const handleSubmit = () => {
        onMessageSubmit(message, file);

        setMessage('');
    }

    return (
        <div className="input-group">
            <input id="btn-input" type="text" name="message" className="form-control input-sm"
                   placeholder="Type your message here..." value={ message } onChange={ handleChange } onKeyPress={ handleKeyPress }/>
            <input type="file" name="file" className="form-control input-sm" onChange={ handleFileUpload } />

            <span className="input-group-btn">
                <button className="btn btn-primary btn-sm" id="btn-chat" onClick={ handleSubmit }>
                    Send
                </button>
            </span>
        </div>
    );
}

export default ChatForm;
