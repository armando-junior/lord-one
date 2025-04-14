import React, { useState } from 'react';

const Bible = () => {
    const [bibles, setBibles] = useState([]);
    const [error, setError] = useState<string | null>(null);
    const [name, setName] = useState<string>(''); // State to store the input value
    const [loading, setLoading] = useState<boolean>(false); // Loading state

    const fetchBibles = async (query: string) => {
        setLoading(true); // Show a loading state
        setError(null); // Reset previous errors
        try {
            const response = await fetch(`/api/bibles?name=${query}`); // Fetch data with query parameter
            const data = await response.json();

            if (data.success) {
                setBibles(data.data); // Update state with fetched bibles
            } else {
                setError('Failed to load Bibles.');
            }
        } catch (err: any) {
            setError(`An error occurred: ${err.message}`); // Handle fetch errors
        } finally {
            setLoading(false); // Hide the loading state
        }
    };

    const handleSearch = (event: React.FormEvent) => {
        event.preventDefault(); // Prevent the form from submitting normally
        fetchBibles(name); // Fetch Bibles with the current input value
    };

    return (
        <div className="p-6">
            <h1 className="text-xl font-bold mb-4">Available Bibles</h1>

            {/* Search Form */}
            <form onSubmit={handleSearch} className="mb-4">
                <input
                    type="text"
                    placeholder="Search by name..."
                    value={name}
                    onChange={(e) => setName(e.target.value)} // Update input value
                    className="border p-2 mr-2 rounded"
                />
                <button
                    type="submit"
                    disabled={loading}
                    className={`px-4 py-2 text-white rounded ${
                        loading ? 'bg-gray-400' : 'bg-blue-600 hover:bg-blue-700'
                    }`}
                >
                    {loading ? 'Searching...' : 'Search'}
                </button>
            </form>

            {/* Error Message */}
            {error && <div className="text-red-500">{error}</div>}

            {/* Bible List */}
            <ul>
                {bibles.map((bible: any) => (
                    <li key={bible.id} className="mb-2">
                        {bible.name} (Language: {bible.language.name})
                    </li>
                ))}
            </ul>

            {/* No Results Message */}
            {!loading && !error && bibles.length === 0 && (
                <div className="text-gray-500">No Bibles found.</div>
            )}
        </div>
    );
};

export default Bible;
